import 'package:dio/dio.dart';
import 'package:get_it/get_it.dart';
import 'package:web/features/auth/Application/auth_bloc.dart';
import 'package:web/features/auth/Date/aouth_repository_impl.dart';
import 'package:web/features/auth/Date/auth_remote_data_source.dart';
import 'package:web/features/auth/Date/auth_repository.dart';
//import 'package:web/features/auth/Date/auth_repository.dart';
import 'package:web/features/auth/Domain/auth_usecase.dart';

final getIt = GetIt.instance;

void setup() {
  getIt.registerSingleton<AuthRemoteDataSource>(AuthRemoteDataSource(Dio()));
  getIt.registerSingleton<AuthRepositoryImpl>(
      AuthRepositoryImpl(getIt<AuthRemoteDataSource>()));
  getIt.registerSingleton<LoginUseCase>(
      LoginUseCase(getIt<AuthRepositoryImpl>() as AuthRepository));
  getIt.registerFactory(() => AuthBloc(getIt<LoginUseCase>()));
}
