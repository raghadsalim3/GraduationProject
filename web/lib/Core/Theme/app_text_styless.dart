import 'dart:ui';

import 'package:web/Core/Theme/app_colors.dart';

class AppTextStyles {
  static const String defaultFontFamily = 'Cairo';

  static TextStyle heading = TextStyle(
    fontSize: 32,
    fontWeight: FontWeight.bold,
    color: AppColors.primaryColor,
    fontFamily: defaultFontFamily,
  );

  static TextStyle body = TextStyle(
    fontSize: 40,
    color: AppColors.textColor2,
    fontFamily: defaultFontFamily,
  );

  static TextStyle button = TextStyle(
    fontSize: 32,
    color: AppColors.textColor1,
    fontWeight: FontWeight.bold,
    fontFamily: defaultFontFamily,
  );

  static TextStyle error = TextStyle(
    fontSize: 14,
    color: AppColors.errorColor,
    fontFamily: defaultFontFamily,
  );
}
