import 'package:flutter/material.dart';
import 'reg.dart';

void main() {
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

