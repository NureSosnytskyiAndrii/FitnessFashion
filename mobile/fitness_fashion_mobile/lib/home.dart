import 'package:fitness_fashion_mobile/shedule.dart';
import 'package:fitness_fashion_mobile/training_page.dart';
import 'package:flutter/material.dart';
import 'exersice.dart';
import 'tips.dart';

class HomePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xff6C757D),
        title: const Center(child: Text('Fitness Fashion')),
      ),
      body: Column(
        children: [
          Expanded(
            child: Container(
              color: Color(0xffDEE2E6),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image(
                        image: AssetImage('assets/images/exercise_logo.png'),
                        height: MediaQuery.of(context).size.height * 0.15,
                      ),
                      ElevatedButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => ExercisesPage()),
                          );
                        },
                        child: Text(
                          'Exersices',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 20,
                          ),
                        ),
                        style: ElevatedButton.styleFrom(
                          primary: Color(0xff6C757D),
                        ),
                      ),
                    ],
                  ),
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image(
                        image: AssetImage('assets/images/training_logo.png'),
                        height: MediaQuery.of(context).size.height * 0.15,
                      ),
                      ElevatedButton(
                       onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => TrainingPage()),
                          );
                        },
                        child: Text(
                          'Trainings',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 20,
                          ),
                        ),
                        style: ElevatedButton.styleFrom(
                          primary: Color(0xff6C757D),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
          Expanded(
            child: Container(
              color: Color(0xffDEE2E6),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image(
                        image: AssetImage('assets/images/notifications_logo.png'),
                        height: MediaQuery.of(context).size.height * 0.15,
                      ),
                      ElevatedButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => Shedule()),
                          );
                        },
                        child: Text(
                          'My shedule',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 20,
                          ),
                        ),
                        style: ElevatedButton.styleFrom(
                          primary: Color(0xff6C757D),
                          
                        ),
                      ),
                    ],
                  ),
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image(
                        image: AssetImage('assets/images/tips_logo.png'),
                        height: MediaQuery.of(context).size.height * 0.15,
                      ),
                      ElevatedButton(
                       onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => TipsPage()),
                          );
                        },
                        child: Text(
                          'Health tips',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 20,
                          ),
                        ),
                        style: ElevatedButton.styleFrom(
                          primary: Color(0xff6C757D),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
