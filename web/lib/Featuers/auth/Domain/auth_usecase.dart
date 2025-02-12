import 'package:web/Featuers/auth/Data/auth_repository.dart';
import 'package:web/Featuers/auth/Domain/user.dart';

class LoginUseCase {
  final AuthRepository repository;

  LoginUseCase(this.repository);

  Future<User> execute(String username, String password) async {
    return await repository.login(username, password);
  }
}
