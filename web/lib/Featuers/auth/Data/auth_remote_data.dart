import 'package:dio/dio.dart';
import 'package:web/Core/Utility/failure.dart';

class AuthRemoteDataSource {
  final Dio dio;
  final String baseUrl;

  AuthRemoteDataSource({required this.dio, required this.baseUrl});

  Future<Map<String, dynamic>> login(String username, String password) async {
    try {
      final response = await dio.post(
        '$baseUrl login', // استخدام baseUrl هنا
        data: {'username': username, 'password': password},
      );

      if (response.statusCode == 200) {
        return response.data;
      } else {
        throw ServerFailure('Failed to login: ${response.statusCode}');
      }
    } on DioException catch (e) {
      throw ServerFailure(e.message ?? 'Failed to login');
    }
  }
}
