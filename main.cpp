//
//  main.cpp
//  proje2hw1
//
//  Created by Tuğba Özkal on 13.03.2017.
//  Copyright © 2017 Tuğba Özkal. All rights reserved.
//

#include <iostream>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include <stdio.h>


#include "mysql_connection.h"
#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/resultset.h>
#include <cppconn/statement.h>


using namespace std;

class cafe{
public:
    int id;                 // id = 1, 2, 3 gibi devam edecek.
    string name;            // name postgre sql'de varchar olarak geciyordu, o tipte degisken olacak.
    int distance;           // distance = 1, 2 ve 3 olabilir. 1 cok yakin, 2 orta, 3 araba ile gidilecek anlaminda kullanilabilir.
    bool sensitiveness;     // nem orani %40'in altindaysa false, ustundeyse true olacak.
    int point;              // point = restoranin puani
    bool state;             // state = restoranin durumu. Restoran aktifse true, aktif degilse false olacak.
};


class user{
public:
    int id;
    string name;
    string mail;
};

void cafe_decider(int wc, int t){
    sql::Driver *driver;
    sql::Connection *con;
    sql::Statement *stmt;
    sql::ResultSet *res;
    
    
    /* Create a connection */
    driver = get_driver_instance();
    con = driver->connect("tcp://localhost:3306", "root", "");     // BU KISIMDA USER NAME VE PASSWORD DEGISTIRILMELI!!!
    
    
    cafe cafes[100];
    cafe result[100];
    
    user people[100];

    /* Connect to the MySQL restaurant database */
    con->setSchema("restaurant");
    stmt = con->createStatement();
    
    res = stmt->executeQuery("SELECT id FROM lastcafe");
    res->next();
    int lid = res->getInt(1);
    
    int i = 0;
    res = stmt->executeQuery("SELECT * FROM restaurant");
    while(res->next()){
        cafes[i].id = res->getInt(1);
        cafes[i].name = res->getString(2);
        cafes[i].distance = res->getInt(3);
        cafes[i].sensitiveness = res->getBoolean(4);
        cafes[i].point = res->getInt(5);
        cafes[i].state = res->getBoolean(6);
        i++;
    }
    
    
    res = stmt->executeQuery("SELECT COUNT(*) AS cafenum FROM restaurant;");
    res->next();
    int cafeNumber = res->getInt("cafenum");
    
    
    /* Connect to the MySQL user database */
    //con->setSchema("user");
    //stmt = con->createStatement();
    
    
    i = 0;
    res = stmt->executeQuery("SELECT * FROM user");
    while(res->next()){
        people[i].id = res->getInt(1);
        people[i].name = res->getString(2);
        people[i].mail = res->getString(3);
        i++;
    }
    
    
    res = stmt->executeQuery("SELECT COUNT(*) AS usernum FROM user;");
    res->next();
    int userNumber = res->getInt("usernum");
    
    if(t == 1){
        for(int i = 0; i < cafeNumber; i++){
            cafes[i].point = cafes[i].point / userNumber;
            string com1 = "UPDATE restaurant SET point = ";
            com1 = com1 + to_string(cafes[i].point) + " WHERE id = ";
            com1 = com1 + to_string(cafes[i].id) + ";";
            res = stmt->executeQuery(com1.c_str());

        }
        
        string com3 = "UPDATE isVotePermitted SET permitted=0; ";
        res = stmt->executeQuery(com3.c_str());
        
    }
    
    
    if(t == 2){
        string com4 = "UPDATE user SET isVoted=0; ";
        res = stmt->executeQuery(com4.c_str());
        string com5 = "UPDATE isVotePermitted SET permitted=1; ";
        res = stmt->executeQuery(com5.c_str());
    }
    

    
    int j = 0;
    if(wc == 1){
        for(int i = 0; i < cafeNumber; i++){
            if(cafes[i].sensitiveness != true && cafes[i].distance != 2 && cafes[i].state == true && cafes[i].point > 0 && cafes[i].id != lid){
                j++;
                result[j] = cafes[i];
            }
        }
    }
    else if(wc == 0){
        for(int i = 0; i < cafeNumber; i++){
            if(cafes[i].state == true && cafes[i].point > 0 && cafes[i].id != lid ){
                j++;
                result[j] = cafes[i];
            }
        }
    }
    
    if(j == 0){
        //Herhangi bir olumlu sonuc bulamadiginda dondurecegi deger
        cout << "0";
    }
    else{
        srand(time(NULL));
        int t = rand() % j + 1;
        cout << result[t].id;
        //cout << result[t].id << endl;
        
        /* update last restaurant table */
        try{
            //con->setSchema("restaurant");
            //stmt = con->createStatement();
    
            string com = "UPDATE lastcafe SET id = ";
            com = com + to_string(result[t].id) + ";";
            res = stmt->executeQuery(com.c_str());
        }
        catch (const exception& e)
        {
            cout << e.what();
        }
        
        try{
            con->setSchema("restaurant");
            stmt = con->createStatement();
            
            result[t].point--;            
            
            string com2 = "UPDATE restaurant SET point = ";
            com2 = com2 + to_string(result[t].point) + " WHERE id = ";
            com2 = com2 + to_string(result[t].id) + ";";
            res = stmt->executeQuery(com2.c_str());

        }
        catch (const exception& e)
        {
            cout << e.what();
        }
        
        
        /* Alttaki kisimda tum uyelere gidilecek yer bilgisi mail atiliyor. */
        for(int i = 0; i < userNumber; i++){
            // gonderen mail adresi: computerprojecttwo@gmail.com
            string command = "bash callpython.sh ";
            command = command + people[i].mail + " \"Merhaba " + people[i].name + ", \nBugun gideceginiz yer: " + result[t].name + " \n\nAfiyet olsun\" ";
            system(command.c_str());
        }
    }
    
    delete con;
    delete stmt;
    delete res;
    
    
    return;

}

/*
 argv[1] = hava durumu, %40'in ustundeyse true, altindaysa false.
 argv[2] = oylama tarih ve saatinin kontrolu
 */


int main(int argc, const char * argv[]) {
    
    int x = atoi(argv[1]);
    int t = atoi(argv[2]);
    
    
    int weatherCondition = 0;

    if(x>=40){
        weatherCondition = 1;
    }
    else{
        weatherCondition = 0;
    }
    
    cafe_decider(weatherCondition, t);
    
    return EXIT_SUCCESS;
}
