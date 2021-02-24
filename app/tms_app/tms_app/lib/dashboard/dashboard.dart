import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';
import 'package:google_sign_in/google_sign_in.dart';
import 'package:tms_app/NetworkState.dart';
import 'package:tms_app/User/user.dart';
import 'package:tms_app/login/login.dart';
import 'package:recase/recase.dart';
import 'package:tms_app/main.dart';
import 'package:http/http.dart' as http;

import '../choice.dart';

class Dashboard extends StatefulWidget {
  final js;
  final NetworkStateSingleton ns;
  final FirebaseAuth auth;
  final GoogleSignIn googleSignIn;
  Dashboard({Key key, this.js, this.ns, this.auth, this.googleSignIn}) : super(key: key);
  @override
  DashBoardState createState() => new DashBoardState();
}

class DashBoardState extends State<Dashboard> {
  Choice _value = choices[0];
  var source;
  var nin;
  void _select(Choice choice, {s}) {
    setState(() {
      _value = choice;
    });
    if (choice.title == 'Logout') {
      if(source == 'SQL'){
	http.get('http://192.168.61.1/actions/app/logout.php?nin='+nin);
	 Navigator.pushReplacement(
              context,
              MaterialPageRoute(
                  builder: (context) => MyHomePage(
                        ns: widget.ns,
                      )));
       } else if( source == 'Google' ){ 
	 _googleSignOut() ;
       }else print(widget.ns.hasConnection);
    }
  }

  void _googleSignOut() {
    signOutUsingGoogle();
    Navigator.pushReplacement(
        context,
        MaterialPageRoute(
            builder: (context) => MyHomePage(
                  ns: widget.ns,
                )));
  }
  
  void signOutUsingGoogle() async{
    await widget.auth.signOut().then((_){
      widget.googleSignIn.signOut();
      print("Signed out successfully");
    });
  }

  DashBoardState();

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<User>(
      future: widget.js,
      builder: (context, snapshot) {
        switch (snapshot.connectionState) {
          case ConnectionState.none:
            return new Text("No Connection");
          case ConnectionState.waiting:
            return Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                Padding(
                  padding: EdgeInsets.only(bottom: 10.0),
                  child: CircularProgressIndicator(
                      backgroundColor: Colors.lightBlueAccent,
                      strokeWidth: 4.0),
                ),
                Text("Logging In ..."),
              ],
            );
          default:
            if (snapshot.hasError) {
              // if(snapshot.error == )
              return new Text("Error: ${snapshot.error}");
            } else {
              if (snapshot.data.status != 0) {
                Navigator.pushReplacement(context,
                    MaterialPageRoute(builder: (context) => LoginScreen()));
              }
	      nin = snapshot.data.userId;
              source = snapshot.data.source;
              String fN =
                  ReCase(snapshot.data.username.split(' ')[0]).pascalCase;
              String lN =
                  ReCase(snapshot.data.username.split(' ')[1]).pascalCase;
              return Scaffold(
                appBar: AppBar(
                  backgroundColor: Colors.blueGrey,
                  actions: <Widget>[
                    _itemDown(snapshot),
                  ],
                ),
                body: Center(
                    child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: <Widget>[
                    Padding(
                        padding: EdgeInsets.only(bottom: 10.0),
                        child: CircleAvatar(
                          backgroundImage: NetworkImage(snapshot.data.photoUrl),
                          radius: 70.0,
                        )),
                    Padding(
                      padding: EdgeInsets.only(bottom: 8.0),
                      child: Text(
                        snapshot.data.source == 'SQL'
                            ? fN + ' ' + lN
                            : snapshot.data.username,
                        style: TextStyle(fontSize: 18.0),
                      ),
                    ),
                    Padding(
                      padding: EdgeInsets.only(bottom: 8.0),
                      child: Text(
                        "NIN: " + snapshot.data.userId,
                        style: TextStyle(fontSize: 12.0),
                      ),
                    ),
                  ],
                )),
              );
            }
        }
      },
    );
  }

  PopupMenuButton _itemDown(s) => PopupMenuButton<Choice>(
        onSelected: _select,
        color: Colors.grey,
        child: Padding(
          padding:
              EdgeInsets.only(top: 8.0, bottom: 8.0, left: 5.0, right: 7.0),
          child: CircleAvatar(
            backgroundImage: NetworkImage(s.data.photoUrl),
            radius: 20.0,
          ),
        ),
        itemBuilder: (context) {
          return choices.map((Choice f) {
            return PopupMenuItem<Choice>(
                value: f,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: <Widget>[
                    Icon(
                      f.icon,
                      color: Colors.blueGrey,
                    ),
                    Text(f.title)
                  ],
                ));
          }).toList();
        },
      );
}
