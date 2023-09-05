package com.picpaySimplificado.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.picpaySimplificado.Service.TransactionService;
import com.picpaySimplificado.dtos.TransactionDTO;

@RestController
@RequestMapping("/transactions")
public class TransationController {

    @Autowired
    private TransactionService transactionService;


    @PostMapping
    public ResponseEntity<Transaction> createTransaction(@RequesrBody TransactionDTO transaction) throws Throwable{
        Transaction newtransaction = this.transactionService.createTransaction(transaction);
        return new ResponseEntity<>(newtransaction, HttpStatus.OK);
    }


    
}
