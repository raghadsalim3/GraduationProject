import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:web/Core/Utility/failure.dart';
import 'package:web/Featuers/auth/Domain/auth_usecase.dart';
import 'package:web/Featuers/auth/Domain/user.dart';

abstract class AuthEvent {}

class LoginEvent extends AuthEvent {
  final String username;
  final String password;

  LoginEvent({required this.username, required this.password});
}

// States
abstract class AuthState {}

class AuthInitial extends AuthState {}

class AuthLoading extends AuthState {}

class AuthSuccess extends AuthState {
  final User user;

  AuthSuccess(this.user);
}

class AuthFailure extends AuthState {
  final String message;

  AuthFailure(this.message);
}

// BLoC
class AuthBloc extends Bloc<AuthEvent, AuthState> {
  final LoginUseCase loginUseCase;

  AuthBloc(this.loginUseCase) : super(AuthInitial()) {
    on<LoginEvent>(_onLoginEvent);
  }

  Future<void> _onLoginEvent(LoginEvent event, Emitter<AuthState> emit) async {
    emit(AuthLoading());
    try {
      final user = await loginUseCase.execute(event.username, event.password);
      emit(AuthSuccess(user));
    } on Failure catch (e) {
      emit(AuthFailure(e.message));
    }
  }
}
