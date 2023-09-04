package com.picpaySimplificado.Service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

import com.picpaySimplificado.domain.User;

@Service
public class NotificationService {

    @Autowired
    private RestTemplate restTemplate;

    public void sendNotification(User user, String message) {
        String email = user.getEmail();

        SendNotification sendNotification = new SendNotification(email, message);

        ResponseEntity<String> responseEntity = restTemplate.postForEntity(
                "http://04d9z.mocklab.io/notify",
                sendNotification,
                String.class);

        if (responseEntity.getStatusCode().is2xxSuccessful()) {
            System.out.println("Notificação enviada com sucesso!");
        } else {
            System.err.println("Falha ao enviar a notificação.");
        }
    }
}

