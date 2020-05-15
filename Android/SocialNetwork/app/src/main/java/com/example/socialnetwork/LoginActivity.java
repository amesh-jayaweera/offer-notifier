package com.example.socialnetwork;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

public class LoginActivity extends AppCompatActivity {

    private Button loginButton;
    private EditText userEmail, userPassword;
    private TextView createAccount;
    private ProgressDialog loadingBar;
    private ImageView googleLoginBtn;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        createAccount = (TextView) findViewById(R.id.login_create_account);
        loginButton = (Button) findViewById(R.id.login_button);
        userEmail = (EditText) findViewById(R.id.login_email);
        userPassword = (EditText) findViewById(R.id.login_password);
        googleLoginBtn = (ImageView) findViewById(R.id.google_signin_button);

        loadingBar = new ProgressDialog(this);



        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                allowingUserToLogging();
            }
        });


    }

    void  allowingUserToLogging(){

        String email = userEmail.getText().toString();
        String password = userPassword.getText().toString();

        if(email.equals("admin") && password.equals("123")){
            Intent intent = new Intent(LoginActivity.this,MainActivity.class);
            startActivity(intent);
        }else{
            Toast.makeText(this,"Login Failed",Toast.LENGTH_SHORT).show();
        }
    }


}