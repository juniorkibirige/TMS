import 'dart:async';
import 'dart:io';

import 'package:connectivity/connectivity.dart';
import 'package:http/http.dart' as http;

class NetworkStateSingleton {
  static final NetworkStateSingleton _state = new NetworkStateSingleton._internal();
  NetworkStateSingleton._internal();

  static NetworkStateSingleton getInstance() => _state;
  bool hasConnection = false;
  StreamController connectionChangeController = new StreamController.broadcast();
  final Connectivity _connectivity = Connectivity();

  void initialize() {
    _connectivity.onConnectivityChanged.listen(_connectionChange);
    checkConnection();
  }

  Stream get connectionChange => connectionChangeController.stream;

  void dispose() {
    connectionChangeController.close();
  }

  void _connectionChange(ConnectivityResult result) {
    checkConnection();
  }

  Future<bool> checkConnection() async {
    bool previousConnection = hasConnection;

    try {
      final result = await http.get('google.com');
      print(result.statusCode);
      if(result.statusCode == 200) {
        hasConnection = true;
      } else {
        hasConnection = false;
      }
    } on SocketException catch (_) {
      hasConnection = false;
    } catch(_) {
      hasConnection = false;
    }

    if(previousConnection != hasConnection){
      connectionChangeController.add(hasConnection);
    }
    return hasConnection;
  }
}