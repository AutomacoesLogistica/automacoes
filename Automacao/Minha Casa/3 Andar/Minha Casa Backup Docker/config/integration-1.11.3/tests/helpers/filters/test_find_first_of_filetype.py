"""Helpers: Filters: find_first_of_filetype."""
# pylint: disable=missing-docstring
from aiogithubapi.objects.repository.content import AIOGitHubAPIRepositoryTreeContent

from custom_components.hacs.helpers.functions.filters import find_first_of_filetype


def test_valid_objects():
    tree = [
        AIOGitHubAPIRepositoryTreeContent(
            {"path": "test/path/file.file", "type": "blob"}, "test/test", "main"
        ),
        AIOGitHubAPIRepositoryTreeContent(
            {"path": "test/path/sub", "type": "blob"}, "test/test", "main"
        ),
    ]
    assert find_first_of_filetype(tree, "file", "filename") == "file.file"


def test_valid_list():
    tree = ["file.file", "test/path/sub/test.file"]
    assert find_first_of_filetype(tree, "file", "filename") == "file.file"


def test_not_valid():
    tree = [
        AIOGitHubAPIRepositoryTreeContent(
            {"path": ".github/path/file.yaml", "type": "blob"}, "test/test", "main"
        ),
        AIOGitHubAPIRepositoryTreeContent(
            {"path": ".github/path/file.js", "type": "blob"}, "test/test", "main"
        ),
    ]
    assert not find_first_of_filetype(tree, "file", "filename")
