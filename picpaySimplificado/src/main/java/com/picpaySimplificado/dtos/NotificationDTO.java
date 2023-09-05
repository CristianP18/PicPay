package com.picpaySimplificado.dtos;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

import com.picpaySimplificado.domain.User;

@Service
public class NotificationDTO {

    @Autowired
    private RestTemplate restTemplate;

    public void sendNotification(User user, String message) throws Exception {
        String email = user.getEmail();
        NotificationRequest notificationRequest = new NotificationRequest(email, message);

        ResponseEntity<String> notificationResponse = restTemplate.postForEntity(
                "http://04d9z.mocklab.io/notify",
                
                notificationRequest,
                String.class);

        if (notificationResponse.getStatusCode() != HttpStatus.OK) {
            throw new Exception("Serviço de notificação está fora do ar");
        } else {
            System.out.println("Notificação enviada com sucesso");
        }
    }
}
