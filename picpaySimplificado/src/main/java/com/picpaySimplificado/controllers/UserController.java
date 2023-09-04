package com.picpaySimplificado.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

import com.picpaySimplificado.domain.User;

@RestController("/users")
public class UserController<userDTO> {

    @Autowired



    @PostMapping
    public ResponseEntity<User> creatUser(userDTO user){
        return null;
        
    }
    
}
//Parei nos 54 min de video