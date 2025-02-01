import 'package:web/features/auth/Date/auth_repository.dart';
import 'package:web/features/auth/Domain/User.dart';

class LoginUseCase {
  final AuthRepository repository;

  LoginUseCase(this.repository);

  Future<User> execute(String username, String password) async {
    return await repository.login(username, password);
  }
}
