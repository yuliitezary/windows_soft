// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the MIT Licence.
// See the LICENCE file in the repository root for full licence text.

#nullable disable

using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using osu.Framework.Platform;
using osu.Game.Extensions;
using osu.Game.Utils;
using SharpCompress.Archives.Zip;

namespace osu.Game.Database
{
    /// <summary>
    /// A class which handles exporting legacy user data of a single type from osu-stable.
    /// </summary>
    public abstract class LegacyExporter<TModel>
        where TModel : class, IHasNamedFiles
    {
        /// <summary>
        /// Max length of filename (including extension).
        /// </summary>
        /// <remarks>
        /// <para>
        /// The filename limit for most OSs is 255. This actual usable length is smaller because <see cref="Storage.CreateFileSafely(string)"/> adds an additional "_<see cref="Guid"/>" to the end of the path.
        /// </para>
        /// <para>
        /// For more information see <see href="https://www.ibm.com/docs/en/spectrum-protect/8.1.9?topic=parameters-file-specification-syntax">file specification syntax</see>, <seealso href="https://en.wikipedia.org/wiki/Comparison_of_file_systems#Limits">file systems limitations</seealso>
        /// </para>
        /// </remarks>
        public const int MAX_FILENAME_LENGTH = 255 - (32 + 4 + 2 + 5); //max path - (Guid + Guid "D" format chars + Storage.CreateFileSafely chars + account for ' (99)' suffix)

        /// <summary>
        /// The file extension for exports (including the leading '.').
        /// </summary>
        protected abstract string FileExtension { get; }

        protected readonly Storage UserFileStorage;

        private readonly Storage exportStorage;

        protected LegacyExporter(Storage storage)
        {
            exportStorage = storage.GetStorageForDirectory(@"exports");
            UserFileStorage = storage.GetStorageForDirectory(@"files");
        }

        protected virtual string GetFilename(TModel item) => item.GetDisplayString();

        /// <summary>
        /// Exports an item to a legacy (.zip based) package.
        /// </summary>
        /// <param name="item">The item to export.</param>
        public void Export(TModel item)
        {
            string itemFilename = GetFilename(item).GetValidFilename();

            if (itemFilename.Length > MAX_FILENAME_LENGTH - FileExtension.Length)
                itemFilename = itemFilename.Remove(MAX_FILENAME_LENGTH - FileExtension.Length);

            IEnumerable<string> existingExports =
                exportStorage
                    .GetFiles(string.Empty, $"{itemFilename}*{FileExtension}")
                    .Concat(exportStorage.GetDirectories(string.Empty));

            string filename = NamingUtils.GetNextBestFilename(existingExports, $"{itemFilename}{FileExtension}");

            using (var stream = exportStorage.CreateFileSafely(filename))
                ExportModelTo(item, stream);

            exportStorage.PresentFileExternally(filename);
        }

        /// <summary>
        /// Exports an item to the given output stream.
        /// </summary>
        /// <param name="model">The item to export.</param>
        /// <param name="outputStream">The output stream to export to.</param>
        public virtual void ExportModelTo(TModel model, Stream outputStream)
        {
            using (var archive = ZipArchive.Create())
            {
                foreach (var file in model.Files)
                    archive.AddEntry(file.Filename, UserFileStorage.GetStream(file.File.GetStoragePath()));

                archive.SaveTo(outputStream);
            }
        }
    }
}