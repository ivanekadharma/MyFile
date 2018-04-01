package com.dog.testing;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class DataHelper extends SQLiteOpenHelper {

    public static final String TABLE_NAME = "users";
    public static final String COLUMN_ID = "id";
    public static final String COLUMN_USERNAME = "username";
    public static final String COLUMN_PASSWORD = "password";
    public static final String COLUMN_BIRTHDATE = "birthDate";
    public static final String COLUMN_PHONENUMB = "phoneNumb";

    private static final String db_name = "kasirku.db";
    private static final int db_version = 1;


    private static final String db_create =
            "create table "+TABLE_NAME+ "("
            + COLUMN_ID + "integer primary key autoincrement, "
            + COLUMN_USERNAME + "varchar(50) not null, "
            + COLUMN_PASSWORD + "varchar(50) not null, "
            + COLUMN_BIRTHDATE + "varchar(50) not null, "
            + COLUMN_PHONENUMB + "varchar(50) not null"
            + ");";

    public DataHelper(Context context){
        super(context, db_name, null, db_version);
    }

    @Override
    public void onCreate(SQLiteDatabase db){
        Log.d("Data", "onCreate: "+db_create);
        db.execSQL(db_create);
    }

    @Override
    public void onUpgrade (SQLiteDatabase db, int oldVersion, int newVersion){
        Log.w(DataHelper.class.getName(), "Upgrading database from version" + oldVersion + "to"+ newVersion + ", which will destroy all old data");
        db.execSQL("DROP TABLE IF EXISTS "+ TABLE_NAME);
        onCreate(db);
    }
}
