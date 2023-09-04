package com.picpaySimplificado.UserService;

import java.math.BigDecimal;
import java.time.LocalDateTime;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

import com.picpaySimplificado.domain.User;
import com.picpaySimplificado.dtos.TransactionDTO;
import com.picpaySimplificado.transaction.Transaction;

@Service
public class TransactionService {

    @Autowired
    private UserService userService;

    @Autowired
    private TransactionRepository transactionRepository; // Corrigido o nome do repositório

    @Autowired
    private RestTemplate restTemplate; // Corrigido o nome da variável

    public void createTransaction(TransactionDTO transaction) throws Exception { // Corrigido o tipo de exceção
        User sender = this.userService.findUserById(transaction.getSenderId()); // Corrigido o método

        // Corrigido o nome da variável e do método
        User receiver = this.userService.findUserById(transaction.getReceiverId());

        userService.validateTransaction(sender, transaction.getValue()); // Corrigido o método e a variável

        if (!this.authorizeTransaction(sender, transaction.getValue())) { // Corrigido a condição
            throw new Exception("Transação não autorizada");
        }

        Transaction newTransaction = new Transaction(); // Corrigido o nome da variável
        newTransaction.setAmount(transaction.getValue()); // Corrigido o método e a variável
        newTransaction.setSender(sender);
        newTransaction.setReceiver(receiver);
        newTransaction.setTimestamp(LocalDateTime.now()); // Corrigido o método e a variável

        transactionRepository.save(newTransaction); // Salvando a transação no repositório
    }

    public boolean authorizeTransaction(User sender, BigDecimal value) {
        ResponseEntity<Map> authorizationResponse = restTemplate.getForEntity(
                "https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6", Map.class);

        if (authorizationResponse.getStatusCode() == HttpStatus.OK) { // Corrigido o nome do enum
            String message = (String) authorizationResponse.getBody().get("message");
            return "Autorizado".equals(message); // Corrigido a condição
        } else {
            return false;
        }
    }
}
