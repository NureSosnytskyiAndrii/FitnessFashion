import 'dart:developer';

import 'package:flutter/material.dart';

import 'database/MYSQL.dart';

class HealthTips {
  int id;
  String name;
  String description;

  HealthTips({required this.id, required this.name, required this.description});
}

Future<List<HealthTips>> getSQLData() async {
  final List<HealthTips> healthTipsList = [];
  final Mysql db = new Mysql();
    print("FFF\n");
  await db.getConnection().then((conn) async {
    print(conn.toString());
    String sqlQuery = 'select * from health_hint';
    await conn.query(sqlQuery).then((results) {
      for (var res in results) {
        final healthTipModel = HealthTips(
            id: res["health_hint_id"],
            name: res["hint_name"],
            description: res["hint_description"]);

        healthTipsList.add(healthTipModel);
      }
    }).onError((error, stackTrace) {
      print(error);
      return null;
    });
    conn.close();
  });

  return healthTipsList;
}
