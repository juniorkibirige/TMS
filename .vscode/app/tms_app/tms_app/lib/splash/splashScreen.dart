import 'dart:async';

import 'package:flutter/material.dart';
import 'package:tms_app/main.dart';

import '../NetworkState.dart';

class SplashScreen extends StatefulWidget {
  final NetworkStateSingleton ns;

  const SplashScreen({Key key, this.ns}) : super(key: key);
  @override
  State<StatefulWidget> createState() => SplashScreenState();
}

class SplashScreenState extends State<SplashScreen> {
  // bool isLoggedIn
  @override
  void initState() {
    super.initState();
    loadData();
  }

  

  Future<Timer> loadData() async {
    return new Timer(Duration(seconds: 5), onDoneLoading);
  }

  onDoneLoading() async{
    Navigator.of(context).pushReplacement(
      MaterialPageRoute(builder: (context) => MyHomePage(ns: widget.ns))
    );
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        image: DecorationImage(
          image: AssetImage('assets/favicon.png'),
          fit: BoxFit.scaleDown,
        ),
      ),
      child: Center(
          child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        children: <Widget>[
          Padding(
            padding: EdgeInsets.only(bottom: 8.0),
            child: new Text(
              'Loading resources ...',
              style: TextStyle(
                fontFamily: "Roboto",
                color: Colors.cyanAccent,
              ),
            ),
          ),
          Padding(
              padding: const EdgeInsets.only(bottom: 18.0),
              child: Container(
                padding: EdgeInsets.all(10.0),
                child: new CircularProgressIndicator(
                  valueColor: AlwaysStoppedAnimation<Color>(Colors.blueGrey),
                ),
              )),
        ],
      )),
    );
  }
}
