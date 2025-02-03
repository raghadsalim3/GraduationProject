import 'package:web/Featuers/auth/Domain/user.dart';

abstract class AuthRepository {
  Future<User> login(String username, String password);
}
