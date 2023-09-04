package com.picpaySimplificado.UserService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.picpaySimplificado.domain.User;
import com.picpaySimplificado.dtos.TransactionDTO;
import com.picpaySimplificado.transaction.Transaction;

@Service
public class TransactionService {

    @Autowired
    private UserService userService;

    @Autowired
    private Transaction repository;

    public void createTransaction(TransactionDTO transaction) throws Throwable{
        User sender = this.userService.findUserById(transaction.senderId());
    }

    
}
