package com.picpaySimplificado.dtos;

import java.math.BigDecimal;

import com.picpaySimplificado.domain.UserType;

public record UserDTO(String fistName, String lastName, String document, BigDecimal balance, String email, String password, UserType userType){
    
}
