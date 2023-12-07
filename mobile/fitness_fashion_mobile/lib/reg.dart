import 'home.dart';
import 'dart:convert';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:crypto/crypto.dart';

class User {
  String id;
  String username;
  String email;
  String pass;
  //int exId;

  User({
    required this.id,
    required this.username,
    required this.email,
    required this.pass,
    /*required this.exId*/
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['user_id'] as String,
      username: json['username'] as String,
      email: json['email'] as String,
      pass: json['hashed_password'] as String,
      //exId: json['url'] as int,
    );
  }
}

Future<List<User>> fetchTips(http.Client client) async {
  final response = await client
      .get(Uri.parse('https://192.168.0.108/fitnessFashion/user.php'));

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseTips, response.body);
}

List<User> parseTips(String responseBody) {
  final parsed =
      (jsonDecode(responseBody) as List).cast<Map<String, dynamic>>();

  return parsed.map<User>((json) => User.fromJson(json)).toList();
}

bool isAuthorithed(String login, String pass, List<User> users) =>
    md5.convert(utf8.encode(pass)).toString() ==
    users.firstWhere((user) {
      print("bd: ${user.pass}\npass: ${
        md5.convert(utf8.encode(pass)).toString()}");
      if (user.username == login || user.email == login) return true;
      return false;
    }).pass;

class RegistrationPage extends StatefulWidget {
  @override
  State<RegistrationPage> createState() => _RegistrationPageState();
}

class _RegistrationPageState extends State<RegistrationPage> {
  final TextEditingController emailController = TextEditingController();

  final TextEditingController passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xffDEE2E6),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            child: const Text(
              textAlign: TextAlign.center,
              'Welcome to Fitness Fashion!',
              style: TextStyle(
                fontSize: 30,
                fontWeight: FontWeight.bold,
                color: Colors.black,
              ),
            ),
          ),
          const SizedBox(height: 50),
          Padding(
            padding: EdgeInsets.symmetric(horizontal: 30),
            child: TextField(
              decoration: InputDecoration(
                labelText: 'Username',
                border: OutlineInputBorder(),
              ),
              controller: emailController,
            ),
          ),
          const SizedBox(height: 30),
          Padding(
            padding: EdgeInsets.symmetric(horizontal: 30),
            child: TextField(
              decoration: InputDecoration(
                labelText: 'Password',
                border: OutlineInputBorder(),
              ),
              controller: passwordController,
            ),
          ),
          const SizedBox(height: 50),
          ElevatedButton(
            onPressed: () async {
              final isLoggedIn = isAuthorithed(emailController.text,
                  passwordController.text, await fetchTips(http.Client()));
              if (isLoggedIn) {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => HomePage()),
                );
              } else {
                showWrongDialog(context);
              }
            },
            style: ElevatedButton.styleFrom(
              foregroundColor: Colors.white,
              backgroundColor: const Color(0xff6C757D),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(30),
              ),
            ),
            child: const Text(
              'Login',
              style: TextStyle(fontSize: 20),
            ),
          ),
        ],
      ),
    );
  }

  Future<String?> showWrongDialog(BuildContext context) {
    return showDialog<String>(
      context: context,
      builder: (BuildContext context) => Dialog(
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              const Text('Wrong login or password'),
              const SizedBox(height: 15),
              TextButton(
                onPressed: () {
                  Navigator.pop(context);
                },
                child: const Text('Close'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
