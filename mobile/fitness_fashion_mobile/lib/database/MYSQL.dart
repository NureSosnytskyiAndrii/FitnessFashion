import 'package:mysql1/mysql1.dart';

class Mysql {
  static String host = 'localhost',
      user = 'root',
      password = "1234",
      db = 'fitnessfashion';
  static int port = 33006;

  Mysql();

  Future<MySqlConnection> getConnection() async {
    var settings = ConnectionSettings(
      host: host,
      port: port,
      user: user,
      password: password,
      db: db,
    );
    print("precon\n ");
    return await MySqlConnection.connect(settings);
  }
}
