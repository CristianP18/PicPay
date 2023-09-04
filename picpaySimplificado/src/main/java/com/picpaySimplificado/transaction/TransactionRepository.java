package com.picpaySimplificado.transaction;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface TransactionRepository extends JpaRepository<Transaction, Long> {
    // Você pode adicionar métodos de consulta personalizados aqui, se necessário
}
