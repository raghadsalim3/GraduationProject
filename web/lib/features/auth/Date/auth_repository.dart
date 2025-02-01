import 'package:web/features/auth/Domain/User.dart';

abstract class AuthRepository {
  Future<User> login(String username, String password);
}
