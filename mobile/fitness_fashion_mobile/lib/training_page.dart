import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Training {
  String id;
  String name;
  String description;
  //int exId;

  Training(
      {required this.id,
      required this.name,
      required this.description
     });

  factory Training.fromJson(Map<String, dynamic> json) {
    return Training(
        id: json['training_id'] as String,
        name: json['training_name'] as String,
        description: json['training_description'] as String
    );
  }
}

Future<List<Training>> fetchTips(http.Client client) async {
  final response = await client.get(
      Uri.parse('https://192.168.0.108/fitnessFashion/trainings.php'));

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseTips, response.body);
}

List<Training> parseTips(String responseBody) {
  final parsed =
      (jsonDecode(responseBody) as List).cast<Map<String, dynamic>>();

  return parsed.map<Training>((json) => Training.fromJson(json)).toList();
}

class TrainingPage extends StatefulWidget {

  @override
  State<TrainingPage> createState() => _TrainingPageState();
}

class _TrainingPageState extends State<TrainingPage> {
  @override
  Widget build(BuildContext context) => Scaffold(
        backgroundColor: Color(0xffDEE2E6),
        appBar: AppBar(
          title: const Center(child: Text("Trainings")),
          backgroundColor: Color(0xff6C757D),
        ),
        body: Center(
            child: FutureBuilder<List<Training>>(
                future: fetchTips(http.Client()),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const CircularProgressIndicator();
                  } else if (snapshot.hasError) {
                    return Text(snapshot.error.toString());
                  }
                  return ListView.separated(
                      itemBuilder: (BuildContext context, int i) {
                        final trainingData = snapshot.data as List<Training>;
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
                                        alignment: Alignment.center,
                                        padding: EdgeInsets.only(
                                            left: 5, top: 5, bottom: 5),
                                        child: Text(
                                          trainingData[i].name,
                                          style: TextStyle(
                                              fontSize: 20,
                                              color: Color(0xffDEE2E6)),
                                        ),
                                      ),
                                Container(
                                  alignment: Alignment.centerLeft,
                                  padding: EdgeInsets.only(
                                      right: 5, top: 5, bottom: 5),
                                  width:
                                      MediaQuery.of(context).size.width * 0.9,
                                  child: Text(
                                    trainingData[i].description,
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
