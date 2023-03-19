// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

module.exports = {
  env: {
    es2017: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
  ],
  overrides: [
    {
      extends: [
        'plugin:@typescript-eslint/recommended',
        'plugin:@typescript-eslint/recommended-requiring-type-checking',
        'plugin:react-hooks/recommended',
        'plugin:react/recommended',
      ],
      files: ['resources/js/**/*.{ts,tsx}', 'tests/karma/**/*.ts'],
      parser: '@typescript-eslint/parser',
      plugins: [
        '@typescript-eslint',
        'eslint-plugin-react',
        'typescript-sort-keys',
      ],
      rules: {
        '@typescript-eslint/array-type': [
          'error',
          {
            default: 'array',
          },
        ],
        '@typescript-eslint/consistent-type-assertions': 'error',
        '@typescript-eslint/consistent-type-definitions': 'error',
        '@typescript-eslint/dot-notation': 'error',
        '@typescript-eslint/explicit-member-accessibility': [
          'error',
          {
            accessibility: 'no-public',
          },
        ],
        '@typescript-eslint/explicit-module-boundary-types': 'off',
        '@typescript-eslint/indent': [
          'error',
          2,
          {
            FunctionDeclaration: {
              parameters: 'first',
            },
            FunctionExpression: {
              parameters: 'first',
            },
            SwitchCase: 1,
          },
        ],
        '@typescript-eslint/member-delimiter-style': 'error',
        '@typescript-eslint/member-ordering': [
          'error',
          {
            default: {
              memberTypes: [
                'public-static-field',
                'protected-static-field',
                'private-static-field',

                'public-instance-field',
                'protected-instance-field',
                'private-instance-field',

                'public-constructor',
                'protected-constructor',
                'private-constructor',

                'public-static-method',
                'protected-static-method',
                'private-static-method',

                'public-instance-method',
                'protected-instance-method',
                'private-instance-method',
              ],
              order: 'alphabetically-case-insensitive',
            },
          },
        ],
        '@typescript-eslint/naming-convention': 'off',
        '@typescript-eslint/no-explicit-any': 'off',
        // JQuery's `done`/`fail`/`always` aren't properly supported.
        // Even if we change `done` to `then` and `fail` to `catch`, there's
        // no replacement for `always` short of changing the rule itself
        // or appending empty `.then().catch()`.
        // Blindly appending `void` isn't all that useful either.
        '@typescript-eslint/no-floating-promises': 'off',
        '@typescript-eslint/no-invalid-this': 'error',
        '@typescript-eslint/no-parameter-properties': 'off',
        '@typescript-eslint/no-shadow': ['error', { hoist: 'all' }],
        '@typescript-eslint/no-unsafe-argument': 'warn',
        '@typescript-eslint/no-unsafe-assignment': 'warn',
        '@typescript-eslint/no-unsafe-call': 'warn',
        '@typescript-eslint/no-unsafe-member-access': 'warn',
        '@typescript-eslint/no-unsafe-return': 'warn',
        '@typescript-eslint/no-unused-expressions': 'error',
        '@typescript-eslint/no-unused-vars': ['error', { argsIgnorePattern: '^_', ignoreRestSiblings: true }],
        '@typescript-eslint/no-use-before-define': 'off',
        '@typescript-eslint/object-curly-spacing': ['error', 'always'],
        '@typescript-eslint/prefer-for-of': 'error',
        '@typescript-eslint/prefer-function-type': 'error',
        '@typescript-eslint/quotes': [
          'error',
          'single',
          { avoidEscape: true },
        ],
        '@typescript-eslint/restrict-template-expressions': [
          'error',
          {
            allowAny: false,
            allowBoolean: true,
            allowNullish: true,
            allowNumber: true,
          },
        ],
        '@typescript-eslint/semi': ['error', 'always'],
        // TODO: make more strict.
        '@typescript-eslint/strict-boolean-expressions': [
          'error',
          {
            allowAny: true,
            allowNullableBoolean: true,
            allowNullableNumber: true,
            allowNullableString: true,
          },
        ],
        '@typescript-eslint/type-annotation-spacing': 'error',
        '@typescript-eslint/unified-signatures': 'error',
        'dot-notation': 'off',
        'no-invalid-this': 'off',
        'no-shadow': 'off',
        'object-curly-spacing': 'off',
        quotes: 'off',
        'react-hooks/exhaustive-deps': 'error',
        'react/jsx-boolean-value': 'error',
        'react/jsx-curly-spacing': 'error',
        'react/jsx-equals-spacing': 'error',
        'react/jsx-max-props-per-line': ['error', { when: 'multiline' }],
        'react/jsx-no-bind': 'error',
        'react/jsx-sort-props': ['error', { reservedFirst: true }],
        'react/jsx-tag-spacing': ['error', {
          afterOpening: 'never',
          beforeClosing: 'never',
          beforeSelfClosing: 'always',
          closingSlash: 'never',
        }],
        'react/jsx-wrap-multilines': 'error',
        'react/no-deprecated': 'warn',
        'react/no-unsafe': 'off',
        'react/self-closing-comp': 'error',
        semi: 'off',
        'typescript-sort-keys/interface': ['error', 'asc', { caseSensitive: false }],
        'typescript-sort-keys/string-enum': ['error', 'asc', { caseSensitive: false }],
      },
      settings: {
        react: {
          version: 'detect',
        },
      },
    },
    {
      env: {
        browser: true,
        node: false,
      },
      files: ['resources/js/**/*.{ts,tsx}'],
      parserOptions: {
        project: 'tsconfig.json',
        sourceType: 'module',
      },
    },
    {
      env: {
        browser: false,
        node: true,
      },
      files: ['tests/karma/**/*.ts'],
      parserOptions: {
        project: 'tests/karma/tsconfig.json',
        sourceType: 'module',
      },
    },
  ],
  parserOptions: {
    sourceType: 'module',
  },
  plugins: [
    'eslint-plugin-jsdoc',
    'eslint-plugin-import',
  ],
  rules: {
    'arrow-body-style': 'error',
    'arrow-parens': 'error',
    'brace-style': 'error',
    'comma-dangle': ['error', 'always-multiline'],
    complexity: 'off',
    curly: ['error', 'multi-line'],
    'dot-notation': 'error',
    'eol-last': 'error',
    eqeqeq: ['error', 'smart'],
    'guard-for-in': 'error',
    'id-blacklist': [
      'error',
      'any',
      'Number',
      'number',
      'String',
      'string',
      'Boolean',
      'boolean',
      'Undefined',
      'undefined',
    ],
    'id-match': 'error',
    'import/order': ['error', { alphabetize: { order: 'asc' } }],
    'jsdoc/check-alignment': 'error',
    'jsdoc/check-indentation': 'error',
    'jsdoc/newline-after-description': 'error',
    'max-classes-per-file': 'error',
    'max-len': 'off',
    'new-parens': 'error',
    'no-bitwise': 'error',
    'no-caller': 'error',
    'no-console': 'warn',
    'no-empty-function': 'error',
    'no-eval': 'error',
    'no-invalid-this': 'error',
    'no-multiple-empty-lines': 'error',
    'no-new-wrappers': 'error',
    'no-shadow': ['error', { hoist: 'all' }],
    'no-throw-literal': 'error',
    'no-trailing-spaces': 'error',
    'no-undef-init': 'error',
    'no-unsafe-finally': 'error',
    'object-curly-spacing': ['error', 'always'],
    'object-shorthand': 'error',
    'one-var': ['error', 'never'],
    'quote-props': ['error', 'as-needed'],
    quotes: [
      'error',
      'single',
      { avoidEscape: true },
    ],
    radix: 'error',
    semi: ['error', 'always'],
    'sort-keys': ['error', 'asc', { caseSensitive: false }],
    'space-before-function-paren': [
      'error',
      {
        anonymous: 'never',
        asyncArrow: 'always',
        named: 'never',
      },
    ],
    'spaced-comment': 'error',
  },
};
