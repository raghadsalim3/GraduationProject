import 'package:web/features/auth/Date/auth_remote_data_source.dart';
import 'package:web/features/auth/Domain/user.dart';
import 'package:web/features/auth/Utility/failure.dart';

class AuthRepositoryImpl {
  final AuthRemoteDataSource remoteDataSource;

  AuthRepositoryImpl(this.remoteDataSource);

//@override
  Future<User> login(String username, String password) async {
    try {
      final response = await remoteDataSource.login(username, password);
      return User.fromJson(response);
    } on Failure catch (e) {
      throw Failure(e.message);
    }
  }
}
