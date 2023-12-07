import 'dart:io';

import 'package:flutter/material.dart';
import 'reg.dart';

class MyHttpOverrides extends HttpOverrides{
@override
HttpClient createHttpClient(SecurityContext? context){
  return super.createHttpClient(context)
    ..badCertificateCallback = (X509Certificate cert, String host, int port)=> true;
}
}

void main() {
   HttpOverrides.global = MyHttpOverrides();
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
        debugShowCheckedModeBanner: false,
      title: 'Fitness Fashion',
      home: RegistrationPage(),
    );
  }
}

