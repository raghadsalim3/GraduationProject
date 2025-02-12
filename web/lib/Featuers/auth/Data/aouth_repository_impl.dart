import 'package:web/Core/Utility/failure.dart';
import 'package:web/Featuers/auth/Data/auth_remote_data.dart';
import 'package:web/Featuers/auth/Data/auth_repository.dart';
import 'package:web/Featuers/auth/Domain/user.dart';

class AuthRepositoryImpl implements AuthRepository {
  final AuthRemoteDataSource remoteDataSource;

  AuthRepositoryImpl(this.remoteDataSource);

//@override
  @override
  Future<User> login(String username, String password) async {
    try {
      final response = await remoteDataSource.login(username, password);
      return User.fromJson(response);
    } on Failure catch (e) {
      throw Failure(e.message);
    }
  }
}
