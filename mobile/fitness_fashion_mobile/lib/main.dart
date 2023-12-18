import 'dart:io';

import 'package:fitness_fashion_mobile/exersice.dart';
import 'package:fitness_fashion_mobile/exersice_page.dart';
import 'package:fitness_fashion_mobile/shedule.dart';
import 'package:fitness_fashion_mobile/training_page.dart';
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
      home: 
      //ExcersicePage(type: "easy")
      //ExercisesPage()
      //TrainingPage()
      //Shedule()
      RegistrationPage(),
    );
  }
}

