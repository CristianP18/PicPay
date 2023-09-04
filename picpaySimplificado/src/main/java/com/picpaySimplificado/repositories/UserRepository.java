package com.picpaySimplificado.repositories;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

public interface UserRepository<User> extends JpaRepository<User, Long>{
    
    Optional<User> findUserByDocuments(String documents);
    Optional<User> findUserById(Long id);

}