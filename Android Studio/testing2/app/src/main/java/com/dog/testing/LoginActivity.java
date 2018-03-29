package com.dog.testing;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.view.inputmethod.EditorInfo;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class LoginActivity extends AppCompatActivity {

    EditText username, password;
    TextView error_msg, to_register;
    Button btn_login;
    users user;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        error_msg = (TextView) findViewById(R.id.errorMessage);
        btn_login = (Button) findViewById(R.id.btn_login);
        to_register = (TextView) findViewById(R.id.toRegister);

        btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String unamekey = username.getText().toString();
                String passkey = password.getText().toString();


                if(unamekey.isEmpty()){
                    error_msg.setText("Username is required!");
                }
                else if(passkey.isEmpty()){
                    error_msg.setText("Password is required!");
                } else{
                    error_msg.setText("");

                    Intent masuk = new Intent(LoginActivity.this, MainActivity.class );
                    startActivity(masuk);
                }
            }
        });

        to_register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent move = new Intent(LoginActivity.this, RegisterActivity.class);
                startActivity(move);
            }
        });

    }


}
