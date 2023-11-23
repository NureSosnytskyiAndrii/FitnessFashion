import 'package:flutter/material.dart';


class ExercisesPage extends StatelessWidget {
  final List<String> types = [
    'Exercise for arms',
    'Exercise for legs',
    'Exercise for shoulders',
    'Exercise for chest',
    'Exercise for back',
    'Exercise for fists',
    "Exercise for neck",
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xffDEE2E6),
      appBar: AppBar(
        title: Text('Best Exersices'),
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
                  style: TextStyle(fontSize: 20),
                ),
                onPressed: () {
                //   Navigator.push(
                //     context,
                //     MaterialPageRoute(
                //       builder: (context) => NewPage(inputString: types[index], number: index,),
                //     ),
                //   );
                },
              ),
            );
          },
        ),
      ),
    );
  }
}
