import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Exercise {
  String id;
  String name;
  String description;
  String difficulty;
  //int exId;

  Exercise(
      {required this.id,
      required this.name,
      required this.description,
      required this.difficulty});

  factory Exercise.fromJson(Map<String, dynamic> json) {
    return Exercise(
        id: json['exercise_id'] as String,
        name: json['name'] as String,
        description: json['description'] as String,
        difficulty: json['difficulty'] as String);
  }
}

Future<List<Exercise>> fetchTips(http.Client client, String type) async {
  final response = await client.get(
      Uri.parse('https://192.168.0.108/fitnessFashion/exercise_${type}.php'));

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseTips, response.body);
}

List<Exercise> parseTips(String responseBody) {
  final parsed =
      (jsonDecode(responseBody) as List).cast<Map<String, dynamic>>();

  return parsed.map<Exercise>((json) => Exercise.fromJson(json)).toList();
}

class ExcersicePage extends StatefulWidget {
  final String type;
  ExcersicePage({required this.type});

  @override
  State<ExcersicePage> createState() => _ExcersicePageState();
}

class _ExcersicePageState extends State<ExcersicePage> {
  @override
  Widget build(BuildContext context) => Scaffold(
        backgroundColor: Color(0xffDEE2E6),
        appBar: AppBar(
          title: Center (child: Text(widget.type)),
          backgroundColor: Color(0xff6C757D),
        ),
        body: Center(
            child: FutureBuilder<List<Exercise>>(
                future: fetchTips(http.Client(), widget.type),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const CircularProgressIndicator();
                  } else if (snapshot.hasError) {
                    return Text(snapshot.error.toString());
                  }
                  return ListView.separated(
                      itemBuilder: (BuildContext context, int i) {
                        final excersiceData = snapshot.data as List<Exercise>;
                        return Padding(
                          padding: const EdgeInsets.only(
                              left: 10, right: 10, top: 10),
                          child: Container(
                            decoration: BoxDecoration(
                                color: const Color(0xff6C757D),
                                border: Border.all(
                                    //color: Colors.red,
                                    color: const Color(0xff6C757D)),
                                borderRadius:
                                    BorderRadius.all(Radius.circular(20))),
                            child: Column(
                              children: [
                                Container(
                                  //width:
                                     // MediaQuery.of(context).size.width * 0.25,
                                  child: Row(
                                    children: [
                                      Container(
                                        alignment: Alignment.centerLeft,
                                        padding: EdgeInsets.only(
                                            left: 5, top: 5, bottom: 5),
                                        child: Text(
                                          excersiceData[i].name,
                                          style: TextStyle(
                                              fontSize: 20,
                                              color: Color(0xffDEE2E6)),
                                        ),
                                      ),
                                      Container(
                                        alignment: Alignment.centerLeft,
                                        padding: EdgeInsets.only(
                                            left: 5, top: 5, bottom: 5),
                                        child: Text(
                                          "Diff.: " +
                                              excersiceData[i]
                                                  .difficulty
                                                  .toString(),
                                          style: TextStyle(
                                              fontSize: 17,
                                              color: Color(0xffDEE2E6)),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                                Container(
                                  alignment: Alignment.centerLeft,
                                  padding: EdgeInsets.only(
                                      right: 5, top: 5, bottom: 5),
                                  width:
                                      MediaQuery.of(context).size.width * 0.9,
                                  child: Text(
                                    excersiceData[i].description,
                                    style: TextStyle(
                                        fontSize: 17, color: Color(0xffDEE2E6)),
                                    textAlign: TextAlign.left,
                                  ),
                                ),
                              ],
                            ),
                          ),
                        );
                      },
                      separatorBuilder: (BuildContext context, int index) =>
                          const Divider(),
                      itemCount: snapshot.data!.length);
                })),
      );
}
