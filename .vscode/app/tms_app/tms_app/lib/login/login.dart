import 'dart:async';
import 'dart:convert';

import 'package:firebase_auth/firebase_auth.dart';
// import 'package:google_sign_in/google_sign_in.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:tms_app/NetworkState.dart';
import 'package:tms_app/adminPage/adminPage.dart';
import '../User/user.dart';
import 'package:tms_app/Icons/StackedIcons.dart';
import 'package:tms_app/dashboard/dashboard.dart';

// import 'google_sign_in.dart';

class LoginScreen extends StatefulWidget {
  final NetworkStateSingleton ns;

  const LoginScreen({Key key, this.ns}) : super(key: key);
  @override
  State<StatefulWidget> createState() => LoginScreenState();
}

class LoginScreenState extends State<LoginScreen> {
  @override
  Widget build(BuildContext context) {
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle.dark.copyWith(
      statusBarColor: Colors.orange,
    ));
    return new Scaffold(
      resizeToAvoidBottomPadding: false,
      appBar: new AppBar(
        title: Text("TM System"),
        backgroundColor: Colors.black,
      ),
      backgroundColor: Colors.white,
      body: Container(
        width: double.infinity,
        child: new Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            new TmsStackedIcons(),
            new Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                Padding(
                  padding: const EdgeInsets.only(top: 8.0),
                  child: new Text(
                    "Tenant",
                    style: new TextStyle(
                        fontSize: 30.0, color: Colors.orangeAccent),
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.only(top: 8.0),
                  child: new Text(
                    " Management",
                    style:
                        new TextStyle(fontSize: 30.0, color: Colors.redAccent),
                  ),
                )
              ],
            ),
            new Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Padding(
                    padding: const EdgeInsets.only(bottom: 30.0),
                    child: new Text(
                      "System",
                      style: new TextStyle(fontSize: 30.0, color: Colors.grey),
                    ),
                  )
                ]),
            new TmsLoginForm(ns: widget.ns),
            Expanded(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.end,
                children: <Widget>[
                  Padding(
                      padding: const EdgeInsets.only(bottom: 18.0),
                      child: Container(
                        padding: EdgeInsets.all(10.0),
                        child: new Text(
                          "Create Account",
                          style: new TextStyle(
                            fontSize: 17.0,
                            color: Colors.greenAccent,
                          ),
                        ),
                      )),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}

class TmsLoginForm extends StatefulWidget {
  final NetworkStateSingleton ns;

  const TmsLoginForm({Key key, this.ns}) : super(key: key);
  @override
  _TmsLoginFormState createState() => _TmsLoginFormState();
}

// final FirebaseAuth _auth = FirebaseAuth.instance;
// final GoogleSignIn googleSignIn = new GoogleSignIn();
class _TmsLoginFormState extends State<TmsLoginForm> {
  String lang = 'en';
  final tPass = TextEditingController();
  final tUser = TextEditingController();
  String msg = '';
  bool _exists = true;
  bool isLoading = false;
  final FirebaseAuth auth = FirebaseAuth.instance;


  Future<FirebaseUser> signUpWithEmail(email, password) async {
    try {
      FirebaseUser user = (await auth.createUserWithEmailAndPassword(email: email, password: password)).user;
      assert(user != null);
      assert(await user.getIdToken() != null);
      return user;
    } catch (e) {
      // print(e.toString());
      if (e is PlatformException) {
        if (e.code == 'ERROR_EMAIL_ALREADY_IN_USE') {
          print("A user with that email already exists");
        } else if(e.code == 'ERROR_API_NOT_AVAILABLE') {
          print("Google Play Sevices missing from Device");
        }
      }
      return null;
    }
  }

  Future<FirebaseUser> signInWithEmail(String email, String password) async {
    try {
      FirebaseUser user = (await auth.signInWithEmailAndPassword(email: email, password: password)).user;
      assert(user != null);
      assert(await user.getIdToken() != null);
      final FirebaseUser currentUser = await auth.currentUser();
      assert(user.uid == currentUser.uid);
      return user;
    } catch (e){
      print(e.toString());
      return null;
    }
  }
  FocusNode email;

  @override
  Widget build(BuildContext context) {
    FocusScope.of(context).requestFocus(email);
    return new Container(
      width: double.infinity,
      child: isLoading
          ? bodyProgress()
          : new Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                new Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: <Widget>[
                    Container(
                        child: Padding(
                            padding: EdgeInsets.only(
                                left: 5.0, right: 5.0, top: 3.0, bottom: 3.0),
                            child: Text(
                              msg,
                              style:
                                  TextStyle(color: Colors.red, fontSize: 12.0),
                            ))),
                  ],
                ),
                Padding(
                  padding: const EdgeInsets.symmetric(
                      horizontal: 20.0, vertical: 0.0),
                  child: new TextField(
                    decoration: new InputDecoration(
                        labelText: 'Email', hintText: "Email or Username"),
                    controller: tUser,
                    focusNode: email,
                    keyboardType: TextInputType.emailAddress,
                  ),
                ),
                new SizedBox(
                  height: 15.0,
                ),
                Padding(
                  padding: const EdgeInsets.symmetric(
                      horizontal: 20.0, vertical: 0.0),
                  child: new TextField(
                    obscureText: true,
                    decoration: new InputDecoration(
                        labelText: 'Password', hintText: "Password"),
                    controller: tPass,
                  ),
                ),
                new Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Expanded(
                      child: Padding(
                        padding: const EdgeInsets.only(
                            left: 20.0, right: 5.0, top: 10.0),
                        child: GestureDetector(
                          onTap: () {
                            if (tUser.text == '') {
                              return showDialog(
                                  context: context,
                                  builder: (context) {
                                    return AlertDialog(
                                      content: Text("Email Field empty!"),
                                    );
                                  });
                            } else if (tPass.text == '') {
                              return showDialog(
                                  context: context,
                                  builder: (context) {
                                    return AlertDialog(
                                      content: Text("Password field is empty!"),
                                    );
                                  });
                            } else {
                              return _authData(tPass.text, tUser.text);
                            }
                          },
                          child: new Container(
                            alignment: Alignment.center,
                            height: 60.0,
                            decoration: new BoxDecoration(
                                color: Color(0xFF18D191),
                                borderRadius: new BorderRadius.circular(9.0)),
                            child: new Text(
                              "Login",
                              style: new TextStyle(
                                  fontSize: 20.0, color: Colors.white),
                            ),
                          ),
                        ),
                      ),
                    ),
                    Expanded(
                      child: Padding(
                        padding: const EdgeInsets.only(
                          left: 10.0,
                          right: 20.0,
                          top: 10.0,
                        ),
                        child: new Container(
                            alignment: Alignment.center,
                            height: 60.0,
                            child: new Text("Forgot Password?",
                                style: new TextStyle(
                                    fontSize: 17.0, color: Color(0xFF18D191)))),
                      ),
                    ),
                  ],
                ),
              ],
            ),
    );
  }

  var det;
  var dat;
  Future<User> fetchData(url, user, passwd) async {
    final response = await http.post(url, body: {
      "user": user,
      "passwd": passwd,
    });
    det = json.decode(response.body);
    var datauser = json.decode(response.body);
    if (datauser.length == 0) {
      setState(() {
        msg = "Login failed. Due to connection loss";
      });
    } else {
      if (datauser['status'] == 3) {
        setState(() {
          msg = datauser['msg-' + lang];
          _exists = false;
          isLoading = false;
        });
      } else if (datauser['status'] == 2) {
        setState(() {
          msg = datauser['msg-' + lang];
          _exists = false;
          isLoading = false;
        });
      } else if (datauser['status'] == 1) {
        setState(() {
          msg = datauser['msg-' + lang];
          _exists = false;
          isLoading = false;
        });
      } else if (datauser['status'] == 0) {
        _exists = true;
      }
    }
    return User.fromJson(det);
  }

  _authData(String passwd, String user) {
    var url = 'http://192.168.61.1/actions/app/login.php';
    // var url = 'http://10.10.3.164/actions/app/login.php';
    setState(() {
      isLoading = true;
    });
    var res = fetchData(url, user, passwd);
    res.whenComplete(() {
      if (det == null) {
        res.catchError((e) {
          print(e.toString());
        });
        setState(() {
          isLoading = false;
          msg = "Check your internet connection!";
        });
      } else {
        if (_exists) {
          Navigator.pushReplacement(
              context,
              det['rights'] == '4'
                  ? MaterialPageRoute(builder: (context) => Dashboard(js: res, ns: widget.ns))
                  : MaterialPageRoute(
                      builder: (context) => AdminDashboard(js: res, ns: widget.ns)));
        } else {
          _exists = false;
        }
      }
    });
  }

  Column bodyProgress() {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      crossAxisAlignment: CrossAxisAlignment.center,
      children: <Widget>[
        Padding(
          padding: EdgeInsets.only(bottom: 10.0),
          child: CircularProgressIndicator(
              backgroundColor: Colors.lightBlueAccent, strokeWidth: 4.0),
        ),
        Text("Logging in ..."),
      ],
    );
  }
}
