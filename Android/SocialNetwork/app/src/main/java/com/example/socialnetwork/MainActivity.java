package com.example.socialnetwork;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import de.hdodenhof.circleimageview.CircleImageView;

public class MainActivity extends AppCompatActivity {

    private NavigationView navigationView;
    private DrawerLayout drawerLayout;
    private ActionBarDrawerToggle actionBarDrawerToggle;
    private Toolbar mToolbar;

    private TextView username;
    private CircleImageView profileImage;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        // action bar
        mToolbar = (Toolbar) findViewById(R.id.main_page_toolbar);
        setSupportActionBar(mToolbar);
        getSupportActionBar().setTitle("Home");

        // add drawer toggle
        drawerLayout = (DrawerLayout) findViewById(R.id.drwable_layout);
        actionBarDrawerToggle = new ActionBarDrawerToggle(MainActivity.this, drawerLayout, R.string.drawer_open, R.string.drawer_close);
        drawerLayout.addDrawerListener(actionBarDrawerToggle);
        actionBarDrawerToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        // navigation view
        navigationView = (NavigationView) findViewById(R.id.nav_view);


        // add navigation header
        View navView = navigationView.inflateHeaderView(R.layout.nav_header_home_screen);

        username = (TextView) navView.findViewById(R.id.profile_username);
        profileImage = (CircleImageView) navView.findViewById(R.id.profile_image);

        username.setText("Admin");


        // on navigation item selected
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
                UserMenuSelector(menuItem);
                return false;
            }
        });



    }


    @Override
    protected void onStart() {
        super.onStart();

    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(actionBarDrawerToggle.onOptionsItemSelected(item)){
            return true;
        }
        return super.onOptionsItemSelected(item);
    }


    private void UserMenuSelector(MenuItem menuItem) {
        switch (menuItem.getItemId()){

            case R.id.nav_logout:
                Toast.makeText(this,"Logout",Toast.LENGTH_SHORT).show();
                signOut();
                break;
        }
    }

    void signOut(){
        Intent intent = new Intent(MainActivity.this,LoginActivity.class);
        startActivity(intent);
        finish();
    }


    private void goToHomePage(){
        Intent intent = new Intent(MainActivity.this,MainActivity.class);
        startActivity(intent);
    }

}
