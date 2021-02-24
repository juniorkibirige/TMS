import 'package:flutter/material.dart';

class TmsStackedIcons extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return new Stack(
      alignment: Alignment.center,
      children: <Widget>[
        new Container(
          height: 60.0,
          width: 60.0,
          decoration: new BoxDecoration(
            borderRadius: new BorderRadius.circular(50.0),
            color: Color(0xFF18D191)
          ),
          child: new Icon(
            Icons.hot_tub,
            color: Colors.white,
          ),
        ),
        new Container(
          margin: new EdgeInsets.only(
            right: 50.0,
            top: 50.0,
          ),
          height: 60.0,
          width: 60.0,
          decoration: new BoxDecoration(
            borderRadius: new BorderRadius.circular(50.0),
            color: Color(0xFFFC6A7F)
          ),
          child: new Icon(
            Icons.hotel,
            color: Colors.white,
          ),
        ),
        new Container(
          margin: new EdgeInsets.only(
            left: 30.0,
            top: 50.0
          ),
          height: 60.0,
          width: 60.0,
          decoration: new BoxDecoration(
            borderRadius: new BorderRadius.circular(50.0),
            color: Colors.grey
          ),
          child: new Icon(
            Icons.restaurant,
            color: Colors.white
          ),
        ),
        new Container(
          margin: new EdgeInsets.only(
            left: 90.0,
            top: 40.0,
          ),
          height: 60.0,
          width: 60.0,
          decoration: new BoxDecoration(
            borderRadius: new BorderRadius.circular(50.0),
            color: Colors.deepPurpleAccent
          ),
          child: new Icon(
            Icons.place,
            color: Colors.redAccent,
          ),
        )
      ],
    );
  }
}