import 'package:dio/dio.dart';
import 'package:web/Core/Utility/failure.dart';
import 'package:web/Featuers/auth/Data/auth_remote_data.dart';

class MockAuthRemoteDataSource implements AuthRemoteDataSource {
  @override
  Future<Map<String, dynamic>> login(String username, String password) async {
    await Future.delayed(const Duration(seconds: 1)); // محاكاة تأخير الشبكة
    if (username == "koko" && password == "1234") {
      return {
        'username': username,
        'password': password,
      };
    } else {
      throw ServerFailure("Invalid credentials");
    }
  }

  @override
  String get baseUrl => "";

  @override
  Dio get dio => Dio();
}
