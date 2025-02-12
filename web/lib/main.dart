import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'package:web/features/auth/enjection.dart';
import 'features/auth/Application/auth_bloc.dart';
import 'features/auth/Presentation/login_screen.dart';

void main() {
  setup();
  runApp(const MyApp());

  final authBloc = getIt<AuthBloc>();
  authBloc.add(LoginEvent(username: 'test', password: '123'));
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: BlocProvider(
        create: (context) => getIt<AuthBloc>(),
        child: LoginScreen(),
      ),
    );
  }
}
