package com.dog.testing;

import android.app.DatePickerDialog;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.icu.util.Calendar;
import android.nfc.Tag;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

import org.w3c.dom.Text;

public class RegisterActivity extends AppCompatActivity {

    //source SQLITE: https://www.twoh.co/2013/01/24/android-database-sqlite-tutorial-ii-fungsi-create-data/
    private TextView mDisplayDate;
    private DatePickerDialog.OnDateSetListener mDateSetListener;
    EditText username, password, confirmPassword, phoneNumb;
    private DBDataSource dataSource;
    CheckBox chkbox;
    Button btn_regis;
    //TextView error_msg, error_name, error_pwd, error_cpwd, error_dob, error_phoneNumb, error_agree;
    TextView DoBirth;
    TextView error_cpwd, error_phoneNumb;

    //start volley
    public static final String TAG = RegisterActivity.class.getSimpleName();
    private RequestQueue mRequestQueue;
    private static RegisterActivity mInstance;

    //end volley
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        mInstance = this; //volley

        setContentView(R.layout.activity_register);

        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        confirmPassword = (EditText) findViewById(R.id.cpassword);

        chkbox = (CheckBox) findViewById(R.id.agreement);
        btn_regis = (Button) findViewById(R.id.btn_regis);
        phoneNumb = (EditText) findViewById(R.id.PhoneNumb);
        DoBirth = (TextView) findViewById(R.id.DoBirth);


//        error_msg = (TextView) findViewById(R.id.errorMessage);
//
//        error_name = (TextView) findViewById(R.id.error_name);
//        error_pwd = (TextView) findViewById(R.id.error_pwd);
        error_cpwd = (TextView) findViewById(R.id.error_cpwd);
//        error_dob = (TextView) findViewById(R.id.error_DoB);
        error_phoneNumb = (TextView) findViewById(R.id.error_PhoneNumb);
        //error_agree = (CheckBox) findViewById(R.id.error_agree);


        mDisplayDate = (TextView) findViewById(R.id.DoBirth);

        mDisplayDate.setOnClickListener(new View.OnClickListener() {
            @RequiresApi(api = Build.VERSION_CODES.N) //ini tambahan, gaada ini, "cal" nya error
            @Override
            public void onClick(View view) {
                Calendar cal = Calendar.getInstance();
                int year = cal.get(Calendar.YEAR);
                int month = cal.get(Calendar.MONTH);
                int day = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        RegisterActivity.this,
                        android.R.style.Theme_Holo_Light_Dialog_MinWidth,
                        mDateSetListener, year, month, day);
                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();

                }
            }
        );

        mDateSetListener = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int month, int day) {
                //Log.d(TAG, "onDateSet: date "+ month+ "/" + day + "/" + year);

                String date = month+ "/" + day + "/" + year;
                mDisplayDate.setText(date);
            }
        };

        dataSource = new DBDataSource(this); // ini bikin object baru
        dataSource.open();


        btn_regis.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String unamekey = username.getText().toString();
                String passkey = password.getText().toString();
                String cpasskey = confirmPassword.getText().toString();
                String DoBirth = mDisplayDate.getText().toString();
                String numb = phoneNumb.getText().toString();

                //variable penampung untuk save ke sqlite
                String name = null;
                String pwd = null;
                String birthDate = null;
                String phoneNumber = null;
                @SuppressWarnings("unused")

//                String ename = error_name.getText().toString();
//                String epwd = error_pwd.getText().toString();
//                String ecpwd = error_cpwd.getText().toString();
//                String edob = error_dob.getText().toString();
//                String enumb = error_phoneNumb.getText().toString();

                //call class users
                users users;

                if(unamekey.isEmpty()) {
                   // error_name.setText("Username is required !");
                    username.setError("Username is required");
                }

                if(passkey.isEmpty()){
//                    error_pwd.setText("Password is required !");
                    password.setError("Password is required !");
                }

                if()
                if(cpasskey.isEmpty()){
                    error_cpwd.setText("Confirm password is required !");
//                    confirmPassword.setError("Confirm password is required !");
                }


                if(numb.isEmpty()){
                    error_phoneNumb.setText("Phone Number is required !");
//                    phoneNumb.setError("Phone Number is required !");
                }
                else{

                    name = username.getText().toString();
                    pwd = password.getText().toString();
                    phoneNumber = phoneNumb.getText().toString();
                    birthDate = DoBirth.getClass().toString();
/*
                    Switch(view.getId()){
                        case R.id.btn_regis:

                            users = dataSource.createNewUser(name, pwd, birthDate, phoneNumber);

                            Toast.makeText(this, "new User\n" +
                                    "nama" + users.getUsername() +
                                    "password" + users.getPassword() +
                                    "phoneNumber" + users.getPhoneNumb()+
                                    "birthdate"+ users.getBirthDate(), Toast.LENGTH_LONG).show();
                            break;
                    }

*/

                    finish();
                }


//                    users user = new users(unamekey);




            }
        });
    }


    //voley
    public static synchronized RegisterActivity getInstance(){
        return mInstance;
    }

    public RequestQueue getRequestQueue(){
        if(mRequestQueue == null){
            mRequestQueue = Volley.newRequestQueue(getApplicationContext());
        }
        return mRequestQueue;
    }

    public <T> void addToRequestQueue(Request<T> req, String tag){
        req.setTag(TextUtils.isEmpty(tag) ? TAG : tag);
        getRequestQueue().add(req);
    }

    public void cancelPendingRequest(Object tag){
        if(mRequestQueue == null){
            mRequestQueue.cancelAll(tag);
        }
    }
}
