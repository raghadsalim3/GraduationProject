import 'package:dio/dio.dart';
import 'package:get_it/get_it.dart';
import 'package:web/Featuers/auth/Application/auth_bloc.dart';
import 'package:web/Featuers/auth/Data/aouth_repository_impl.dart';
import 'package:web/Featuers/auth/Data/auth_remote_data.dart';
import 'package:web/Featuers/auth/Domain/auth_usecase.dart';

final getIt = GetIt.instance;

void setup() {
  // تسجيل Dio كـ lazy singleton
  getIt.registerLazySingleton<Dio>(() => Dio());

  // تسجيل AuthRemoteDataSource كـ lazy singleton
  getIt.registerLazySingleton<AuthRemoteDataSource>(
    () => AuthRemoteDataSource(
      dio: getIt<Dio>(), // استخدام Dio المسجل
      baseUrl: 'http://127.0.0.1:8000/api', // قم بتحديد baseUrl هنا
    ),
  );

  // تسجيل AuthRepositoryImpl كـ lazy singleton
  getIt.registerLazySingleton<AuthRepositoryImpl>(
    () => AuthRepositoryImpl(getIt<AuthRemoteDataSource>()),
  );

  // تسجيل LoginUseCase كـ lazy singleton
  getIt.registerLazySingleton<LoginUseCase>(
    () => LoginUseCase(getIt<AuthRepositoryImpl>()),
  );

  // تسجيل AuthBloc كـ factory (لإنشاء نسخة جديدة في كل مرة)
  getIt.registerFactory(() => AuthBloc(getIt<LoginUseCase>()));
}
