package com.picpaySimplificado.Service;

import java.math.BigDecimal;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.picpaySimplificado.domain.User;
import com.picpaySimplificado.dtos.UserDTO;
import com.picpaySimplificado.repositories.UserRepository;

@Service
public class UserService {
    @Autowired
    private UserRepository repository;

    public void validateTransaction(User sender, BigDecimal amount) throws Exception {
         // Verifique se o remetente tem saldo suficiente para a transação
    if (sender.getBalance().compareTo(amount) < 0) {
        throw new Exception("Saldo insuficiente para realizar a transação.");
    }
    }

    public Object findUserById(Long id) throws Throwable {
        return this.repository.findById(id).orElseThrow(() -> new Exception("Usuário não encontrado"));
    }

    /**
     * Cria um novo usuário com base nos dados fornecidos pelo DTO e o salva no sistema.
     *
     * @param user O DTO contendo os dados do usuário.
     * @return O novo usuário criado e salvo.
     */
  public User createUserTDO(UserDTO userDto) {
    User newUser = new User(userDto);
    this.saveUser(newUser);
    return newUser;
}


    public List<User> getAllUsers() {
        return this.repository.findAll();
    }

    public void saveUser(User user) {
        this.repository.save(user);
    }

   
}
