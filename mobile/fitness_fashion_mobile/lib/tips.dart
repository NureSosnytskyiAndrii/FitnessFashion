import 'dart:convert';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class HealthTips {
  String id;
  String name;
  String description;
  //int exId;

  HealthTips({
    required this.id,
    required this.name,
    required this.description,
    /*required this.exId*/
  });

  factory HealthTips.fromJson(Map<String, dynamic> json) {
    return HealthTips(
      id: json['health_hint_id'] as String,
      name: json['hint_name'] as String,
      description: json['hint_description'] as String,
      //exId: json['url'] as int,
    );
  }
}

Future<List<HealthTips>> fetchTips(http.Client client) async {
  final response = await client
      .get(Uri.parse('https://192.168.0.108/fitnessFashion/tips.php'));

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseTips, response.body);
}

List<HealthTips> parseTips(String responseBody) {
  final parsed =
      (jsonDecode(responseBody) as List).cast<Map<String, dynamic>>();

  return parsed.map<HealthTips>((json) => HealthTips.fromJson(json)).toList();
}

class TipsPage extends StatefulWidget {
  const TipsPage({super.key});

  @override
  State<TipsPage> createState() => _TipsPageState();
}

class _TipsPageState extends State<TipsPage> {

  @override
  Widget build(BuildContext context) => Scaffold(
      backgroundColor: const Color(0xffDEE2E6),
      appBar: AppBar(
        title: const Center(child:  Text('Helth tips')),
        backgroundColor: const Color(0xff6C757D),
      ),
      body: Center(
      child: /*Container()*/FutureBuilder<List<HealthTips>>(
        future: fetchTips(http.Client()),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const CircularProgressIndicator();
          } else if (snapshot.hasError) {
            return Text(snapshot.error.toString());
          }
          return ListView.separated(
            itemBuilder: (BuildContext context, int i) {
              final data = snapshot.data as List<HealthTips>;
              return Padding(
                padding:
                  const EdgeInsets.only(left: 10, right: 10, top: 10),
                child: Container(
                  width: MediaQuery.of(context).size.width * 0.90,
                  decoration: BoxDecoration(
                    color: const Color(0xff6C757D),
                    border:
                        Border.all(color: const Color(0xff6C757D)),
                    borderRadius:
                        BorderRadius.all(Radius.circular(10))),
                  //height: 50,
                  alignment: Alignment.centerLeft,
                  padding: EdgeInsets.only(left: 5),
                  //color: const Color(0xff6C757D),
                  child: Text(
                    "${i + 1} ${data[i].name}\n${data[i].description}",
                    style: TextStyle(
                      fontSize: 20, color: Color(0xffDEE2E6)),
                  ),
                ),
              );
            },
            separatorBuilder: (BuildContext context, int index) =>
              const Divider(),
            itemCount: snapshot.data!.length);
        }
      )
    )
  );
}