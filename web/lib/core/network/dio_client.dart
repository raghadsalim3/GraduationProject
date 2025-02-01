import 'package:dio/dio.dart';

class DioClient {
  static Dio creatAndSetDio({required String baseUrl}) {
    Dio dio = Dio(
      BaseOptions(
        baseUrl: baseUrl, // استخدام baseUrl ديناميكي
        connectTimeout: const Duration(seconds: 1), // وقت انتظار الاتصال
        receiveTimeout: const Duration(seconds: 10), // وقت انتظار الاستجابة
      ),
    );

    // إضافة LogInterceptor لتسجيل الطلبات والاستجابات
    dio.interceptors.add(LogInterceptor(
      requestBody: true,
      error: true,
      requestHeader: false,
      responseHeader: false,
      request: true,
      responseBody: true,
    ));

    return dio;
  }
}
