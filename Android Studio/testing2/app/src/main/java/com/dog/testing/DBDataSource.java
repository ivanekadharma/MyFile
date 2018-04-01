package com.dog.testing;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

class DBDataSource {

    //inisialisasi SQLite nya
    private SQLiteDatabase database;
    //inisialisasi kelas DataHelper nya
    private DataHelper dataHelper;
    //untuk get semua kolom
    private String[] allColumns = {
            DataHelper.COLUMN_ID, DataHelper.COLUMN_USERNAME, DataHelper.COLUMN_PASSWORD, DataHelper.COLUMN_BIRTHDATE, DataHelper.COLUMN_PHONENUMB
    };

    public DBDataSource (Context context){
        dataHelper = new DataHelper(context);
    }

    public void open()throws SQLException{
        database = dataHelper.getWritableDatabase();
    }

    public void close(){
        dataHelper.close();
    }

    public users createNewUser(String nama, String password, String birthdate, String phoneNumb){

        //function insert
        ContentValues values = new ContentValues();
        values.put(DataHelper.COLUMN_USERNAME, nama);
        values.put(DataHelper.COLUMN_PASSWORD, password);
        values.put(DataHelper.COLUMN_BIRTHDATE, birthdate);
        values.put(DataHelper.COLUMN_PHONENUMB, phoneNumb);
        //ini buat eksekusi insert nya
        long insertId = database.insert(DataHelper.TABLE_NAME, null, values);

        Cursor cursor = database.query(DataHelper.TABLE_NAME, allColumns, DataHelper.COLUMN_ID + "=" + insertId, null, null,null,null);

        cursor.moveToFirst();

        users newUser = cursorToUser(cursor);

        cursor.close();

        return newUser;
    }

    private users cursorToUser(Cursor cursor){
        //create new object
        users user = new users();

        Log.v("info", "The getLONG " + cursor.getLong(0));
        Log.v("info", "The setLatLng " + cursor.getString(1)+ "," + cursor.getString(2)
                                            + "," + cursor.getString(3)+ "," + cursor.getString(4));
        //set atribute
        user.setId(cursor.getLong(0));
        user.setUsername(cursor.getString(1));
        user.setPassword(cursor.getString(2));
        user.setBirthDate(cursor.getString(3));;
        user.setPhoneNumb(cursor.getString(4));

        return user;
    }
}
