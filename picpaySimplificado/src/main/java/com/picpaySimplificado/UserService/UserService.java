package com.picpaySimplificado.UserService;

import java.math.BigDecimal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.picpaySimplificado.domain.User;
import com.picpaySimplificado.domain.UserType;
import com.picpaySimplificado.repositories.UserRepository;
@Service
public class UserService {
    @Autowired
    private UserRepository repository;

    public void validateTransaction(User sender, BigDecimal amount) throws Exception{
        if(sender.getUserType() == UserType.MERCHANT){
            throw new Exception("Usúario do tipo Logista não esta autorizado a realizar transações");
        }
        if(sender.getBalance().compareTo(amount) < 0){
            throw new Exception("Saldo insuficiente");
        }
    }

    public User findUserById(Long id) throws Throwable{
        return (User) this.repository.findUserById(id).orElseThrow(() -> new Exception("Usuário não encontrado"));

    }
    public void saveUser(User user){
        this.repository.save(user);
    }
}
