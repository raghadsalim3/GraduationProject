import 'package:get_it/get_it.dart';
import 'package:dio/dio.dart';
import 'package:web/Core/network/dio_client.dart';
import 'package:web/Featuers/auth/Application/auth_bloc.dart';
import 'package:web/Featuers/auth/Data/mockAuthaRemoteDataSoucrce.dart';
import 'package:web/Featuers/auth/Data/aouth_repository_impl.dart';
import 'package:web/Featuers/auth/Data/auth_remote_data.dart';
import 'package:web/Featuers/auth/Data/auth_repository.dart';
import 'package:web/Featuers/auth/Domain/auth_usecase.dart';

/*
final getIt = GetIt.instance;

void setup() {
  // تسجيل Dio كـ lazy singleton
  getIt.registerLazySingleton<Dio>(() => Dio());

  // تسجيل AuthRemoteDataSource كـ lazy singleton
  getIt.registerLazySingleton<AuthRemoteDataSource>(
    () => AuthRemoteDataSource(
      dio: getIt<Dio>(),
      baseUrl: 'http://127.0.0.1:8000/api/',
    ),
  );

  // تسجيل AuthRepositoryImpl كـ lazy singleton
  getIt.registerLazySingleton<AuthRepositoryImpl>(
    () => AuthRepositoryImpl(getIt<MockAuthRemoteDataSource>()),
  );

  // تسجيل LoginUseCase كـ lazy singleton
  getIt.registerLazySingleton<LoginUseCase>(
    () => LoginUseCase(getIt<AuthRepositoryImpl>()),
  );

  // تسجيل AuthBloc كـ factory (لإنشاء نسخة جديدة في كل مرة)
  getIt.registerFactory(() => AuthBloc(getIt<LoginUseCase>()));
}*/
void setup({bool useMock = false}) {
  final getIt = GetIt.instance;

  // تسجيل Dio بشكل صحيح باستخدام DioClient
  getIt.registerLazySingleton<Dio>(
      () => DioClient.creatAndSetDio(baseUrl: 'http://127.0.0.1:8000/api/'));

  // تسجيل Data Source (حقيقي أو وهمي)
  if (useMock) {
    getIt.registerLazySingleton<AuthRemoteDataSource>(
        () => MockAuthRemoteDataSource());
  } else {
    getIt
        .registerLazySingleton<AuthRemoteDataSource>(() => AuthRemoteDataSource(
              dio: getIt<Dio>(), // التأكد من استدعاء Dio بعد تسجيله
              baseUrl: 'http://127.0.0.1:8000/api/',
            ));
  }

  // تسجيل Repository
  getIt.registerLazySingleton<AuthRepository>(
      () => AuthRepositoryImpl(getIt<AuthRemoteDataSource>()));

  // تسجيل Use Case
  getIt.registerLazySingleton(() => LoginUseCase(getIt<AuthRepository>()));

  // تسجيل BLoC
  getIt.registerFactory(() => AuthBloc(getIt<LoginUseCase>()));
}
