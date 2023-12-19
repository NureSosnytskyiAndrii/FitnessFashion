import 'package:flutter/material.dart';
import 'exersice_page.dart';

class ExercisesPage extends StatelessWidget {
  final List<String> types = [
    'Easy exercises',
    'Average exercises',
    'Hard exercises',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xffDEE2E6),
      appBar: AppBar(
        title: const Center(child: Text('Best Exersices')),
        backgroundColor: Color(0xff6C757D),
      ),
      body: Center(
        child: ListView.builder(
          itemCount: types.length,
          itemBuilder: (context, index) {
            return Padding(
              padding: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  primary: Color(0xff6C757D),
                  padding: EdgeInsets.all(15),
                ),
                child: Text(
                  types[index],
                  style: TextStyle(fontSize: 20, 
                  color: Color(0xffDEE2E6)),
                ),
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ExcersicePage(
                        type: index == 0? "easy" : 
                        index == 1? "normal" : "hard"),
                    ),
                  );
                },
              ),
            );
          },
        ),
      ),
    );
  }
}
