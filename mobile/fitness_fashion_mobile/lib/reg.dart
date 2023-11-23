import 'package:flutter/material.dart';
import 'home.dart';

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
          const Text(
            'Welcome to Fitness Fashion!',
            style: TextStyle(
              fontSize: 30,
              fontWeight: FontWeight.bold,
              color: Colors.black,
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
            onPressed: () {
              final isLoggedIn = true;
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
