package com.picpaySimplificado.dtos;

import org.springframework.dao.DataIntegrityViolationException;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ControllerAdvice;
import org.springframework.web.bind.annotation.ExceptionHandler;

import jakarta.persistence.EntityNotFoundException;

@ControllerAdvice
public class ExceptionDTO {

    public ExceptionDTO(String string, String string2) {
    }

    @ExceptionHandler(DataIntegrityViolationException.class)
    public ResponseEntity<ExceptionDTO> handleDataIntegrityViolation(DataIntegrityViolationException exception) {
        ExceptionDTO exceptionDTO = new ExceptionDTO("Usuário ja cadastrado", "400");
        return ResponseEntity.badRequest().body(exceptionDTO);
    }

    @ExceptionHandler(EntityNotFoundException.class)
    public ResponseEntity<ExceptionDTO> handleEntityNotFound(EntityNotFoundException exception) {
        return ResponseEntity.notFound().build();
    }


    @ExceptionHandler(EntityNotFoundException.class)
    public ResponseEntity threatGeneralException(EntityNotFoundException exception){
         ExceptionDTO exceptionDTO = new ExceptionDTO(exception.getMessage(), "500");
          return ResponseEntity.internalServerError().body(exceptionDTO);

    }
}
