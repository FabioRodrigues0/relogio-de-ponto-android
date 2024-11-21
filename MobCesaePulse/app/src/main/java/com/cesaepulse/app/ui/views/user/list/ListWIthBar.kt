package com.cesaepulse.app.ui.views.user.list

import androidx.compose.runtime.Composable

@Composable
fun Greeting(name: String) {
//	DockedSearchBar(
//		inputField = {
//			SearchBarDefaults.InputField(
//				query = query,
//				onQueryChange = {
//					query = it
//				},
//				onSearch = { expanded = false },
//				expanded = expanded,
//				onExpandedChange = onExpandedChange,
//				modifier = Modifier.fillMaxWidth(),
//				placeholder = { Text(text = stringResource(id = R.string.search_emails)) },
//				leadingIcon = {
//					if (expanded) {
//						Icon(
//							imageVector = Icons.AutoMirrored.Filled.ArrowBack,
//							contentDescription = stringResource(id = R.string.back_button),
//							modifier = Modifier
//								.padding(start = 16.dp)
//								.clickable {
//									expanded = false
//									query = ""
//								},
//						)
//					} else {
//						Icon(
//							imageVector = Icons.Default.Search,
//							contentDescription = stringResource(id = R.string.search),
//							modifier = Modifier.padding(start = 16.dp),
//						)
//					}
//				},
//				trailingIcon = {
//					ReplyProfileImage(
//						drawableResource = R.drawable.avatar_6,
//						description = stringResource(id = R.string.profile),
//						modifier = Modifier
//							.padding(12.dp)
//							.size(32.dp)
//					)
//				},
//			)
//		},
//		expanded = expanded,
//		onExpandedChange = onExpandedChange,
//		modifier = modifier,
//		content = {
//			if (searchResults.isNotEmpty()) {
//				LazyColumn(
//					modifier = Modifier.fillMaxWidth(),
//					contentPadding = PaddingValues(16.dp),
//					verticalArrangement = Arrangement.spacedBy(4.dp)
//				) {
//					items(items = searchResults, key = { it.id }) { email ->
//						ListItem(
//							headlineContent = { Text(email.subject) },
//							supportingContent = { Text(email.sender.fullName) },
//							leadingContent = {
//								ReplyProfileImage(
//									drawableResource = email.sender.avatar,
//									description = stringResource(id = R.string.profile),
//									modifier = Modifier
//										.size(32.dp)
//								)
//							},
//							modifier = Modifier.clickable {
//								onSearchItemSelected.invoke(email)
//								query = ""
//								expanded = false
//							}
//						)
//					}
//				}
//			} else if (query.isNotEmpty()) {
//				Text(
//					text = stringResource(id = R.string.no_item_found),
//					modifier = Modifier.padding(16.dp)
//				)
//			} else
//				Text(
//					text = stringResource(id = R.string.no_search_history),
//					modifier = Modifier.padding(16.dp)
//				)
//		}
//	)
//}
}